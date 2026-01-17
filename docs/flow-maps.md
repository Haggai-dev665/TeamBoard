# TeamBoard Flow Maps

This document visualizes the key application flows (routes → controllers → models/services → views) and where the main business rules live.

> Notes
> - These are **Mermaid** diagrams. GitHub renders Mermaid in Markdown.
> - Routes: [routes/web.php](../routes/web.php)

---

## 1) Auth → Dashboard (role-based routing)

```mermaid
flowchart TD
  A["Browser"] -->|GET /login| R1["routes/web.php"]
  R1 --> C1["LoginController.showLoginForm"]
  C1 --> V1["View: auth/login.blade.php"]

  A -->|POST /login| R2["routes/web.php"]
  R2 --> C2["LoginController.login"]
  C2 -->|validate email + password| VAL1["Laravel validation"]
  C2 -->|Auth attempt| AUTH["Auth session"]
  AUTH -->|success| REDIR["redirect intended /dashboard"]

  A -->|GET /dashboard - auth middleware| R3["routes/web.php"]
  R3 --> D1["DashboardController.index"]
  D1 --> U1{"User is Super Admin?"}
  U1 -->|Yes| AD["adminDashboard"]
  AD --> VM1["View: admin/dashboard.blade.php"]
  U1 -->|No| ED["employeeDashboard"]
  ED --> VM2["View: dashboard.blade.php"]
```

Key code:
- Auth controllers: [app/Http/Controllers/Auth/LoginController.php](../app/Http/Controllers/Auth/LoginController.php), [app/Http/Controllers/Auth/RegisterController.php](../app/Http/Controllers/Auth/RegisterController.php)
- Role rule: [app/Models/User.php](../app/Models/User.php)
- Dashboard branching: [app/Http/Controllers/DashboardController.php](../app/Http/Controllers/DashboardController.php)

---

## 2) Register → Welcome Notification

```mermaid
flowchart TD
  A["Browser"] -->|GET /register| R1["routes/web.php"]
  R1 --> C1["RegisterController.showRegistrationForm"]
  C1 --> V1["View: auth/register.blade.php"]

  A -->|POST /register| R2["routes/web.php"]
  R2 --> C2["RegisterController.register"]
  C2 -->|validate name + email + password| VAL["Laravel validation"]
  C2 -->|User create| M1[(users table)]
  C2 -->|createWelcomeNotification| S1["NotificationService"]
  S1 -->|Notification create| M2[(notifications table)]
  C2 -->|Auth login| AUTH["Auth session"]
  AUTH -->|redirect| DASH["/dashboard"]
```

Key code:
- Register controller: [app/Http/Controllers/Auth/RegisterController.php](../app/Http/Controllers/Auth/RegisterController.php)
- Welcome notification: [app/Services/NotificationService.php](../app/Services/NotificationService.php)

---

## 3) Create Notice → Fan-out Notifications

```mermaid
flowchart TD
  A["Browser"] -->|POST /notices| R["routes/web.php"]
  R --> C["NoticeController.store"]
  C -->|validate title + content + priority| VAL["Laravel validation"]
  C -->|Notice create| N[(notices table)]
  C -->|notifyNewNotice| S["NotificationService"]
  S -->|select users except author| Q["User query"]
  Q -->|foreach user| CR["Notification create"]
  CR --> M[(notifications table)]
  C -->|redirect notices.index| OUT["Browser redirected"]
```

Key code:
- Notice controller: [app/Http/Controllers/NoticeController.php](../app/Http/Controllers/NoticeController.php)
- Service: [app/Services/NotificationService.php](../app/Services/NotificationService.php)
- Models: [app/Models/Notice.php](../app/Models/Notice.php), [app/Models/Notification.php](../app/Models/Notification.php)

---

## 4) Upload Document → Fan-out Notifications

```mermaid
flowchart TD
  A["Browser"] -->|POST /documents| R["routes/web.php"]
  R --> C["DocumentController.store"]
  C -->|validate title + file| VAL["Laravel validation"]
  C -->|store file - public disk| FS[(storage public)]
  C -->|Document create| D[(documents table)]
  C -->|notifyNewDocument| S["NotificationService"]
  S -->|select users except uploader| Q["User query"]
  Q -->|foreach user| CR["Notification create"]
  CR --> N[(notifications table)]
  C -->|redirect documents.index| OUT["Browser redirected"]
```

Key code:
- Document controller: [app/Http/Controllers/DocumentController.php](../app/Http/Controllers/DocumentController.php)
- Model helpers: [app/Models/Document.php](../app/Models/Document.php)

---

## 5) Feedback (Acknowledge/Disagree/Concern) → Concern notifies Super Admin

```mermaid
flowchart TD
  A["Browser"] -->|POST /feedback| R["routes/web.php"]
  R --> C["FeedbackController.store"]
  C -->|validate type + target| VAL["Laravel validation"]

  C --> T{"Target type?"}
  T -->|notice| N1["Notice findOrFail"]
  T -->|document| D1["Document findOrFail"]

  C -->|optional attachment upload| UP[(storage public)]
  C -->|updateOrCreate feedback| F[(feedback table)]

  C --> K{"Concern?"}
  K -->|No| DONE["Back with success"]
  K -->|Yes| SA["Find super admin (config)"]
  SA -->|Notification create| NO[(notifications table)]
  NO -->|link feedback.index| ADMIN["GET /feedback"]
```

Key code:
- Controller: [app/Http/Controllers/FeedbackController.php](../app/Http/Controllers/FeedbackController.php)
- Models: [app/Models/Feedback.php](../app/Models/Feedback.php), [app/Models/Notice.php](../app/Models/Notice.php), [app/Models/Document.php](../app/Models/Document.php)

---

## 6) Notifications → Mark as Read / Mark All as Read (ownership enforced)

```mermaid
flowchart TD
  A["Browser"] -->|POST /notifications/:id/read| R["routes/web.php"]
  R --> C["NotificationController.markAsRead"]
  C --> O{"Owns notification?"}
  O -->|No| ERR["403 Forbidden"]
  O -->|Yes| UPD["markAsRead"]
  UPD --> DB[(notifications read = true)]
  DB --> OUT["Back or JSON success"]

  A -->|POST /notifications/mark-all-read| R2["routes/web.php"]
  R2 --> C2["NotificationController.markAllAsRead"]
  C2 -->|update unread scoped| DB2[(notifications read = true for user)]
  DB2 --> OUT2["Back or JSON success"]
```

Key code:
- Controller: [app/Http/Controllers/NotificationController.php](../app/Http/Controllers/NotificationController.php)
- Model scope/helper: [app/Models/Notification.php](../app/Models/Notification.php)

---

## 7) Employees CRUD (Policy-based authorization)

```mermaid
flowchart TD
  A["Browser"] -->|GET /employees| R1["routes/web.php"]
  R1 --> C1["EmployeeController.index"]
  C1 -->|query + filters + paginate| Q1["Employee query"]
  Q1 --> V1["View: employees/index.blade.php"]

  A -->|GET /employees/create| R2["routes/web.php"]
  R2 --> C2["EmployeeController.create"]
  C2 -->|authorize create employee| P1["EmployeePolicy.create"]
  P1 -->|admin only| V2["View: employees/create.blade.php"]

  A -->|POST /employees| R3["routes/web.php"]
  R3 --> C3["EmployeeController.store"]
  C3 -->|authorize + validate| VAL["Laravel validation"]
  C3 -->|Employee create| DB[(employees table)]
  C3 -->|notifyEmployeeAdded| S["NotificationService"]
  S -->|if matching user by email| N[(notifications table)]
  C3 --> OUT["redirect employees.index"]

  A -->|GET /employees/:employee/edit| R4["routes/web.php"]
  R4 --> C4["EmployeeController.edit"]
  C4 -->|authorize update employee| P2["EmployeePolicy.update"]
  P2 --> V3["View: employees/edit.blade.php"]

  A -->|DELETE /employees/:employee| R5["routes/web.php"]
  R5 --> C5["EmployeeController.destroy"]
  C5 -->|authorize delete employee| P3["EmployeePolicy.delete"]
  P3 -->|delete photo if exists| FS[(storage public)]
  C5 -->|Employee delete| DB2[(employees table)]
  C5 --> OUT2["redirect employees.index"]
```

Key code:
- Controller: [app/Http/Controllers/EmployeeController.php](../app/Http/Controllers/EmployeeController.php)
- Policy: [app/Policies/EmployeePolicy.php](../app/Policies/EmployeePolicy.php)
- Policy registration: [app/Providers/AuthServiceProvider.php](../app/Providers/AuthServiceProvider.php)

---

## 8) Settings (Profile + Password)

```mermaid
flowchart TD
  A["Browser"] -->|GET /settings| R1["routes/web.php"]
  R1 --> C1["SettingsController.index"]
  C1 --> V1["View: settings/index.blade.php"]

  A -->|POST /settings/profile| R2["routes/web.php"]
  R2 --> C2["SettingsController.updateProfile"]
  C2 -->|validate name + unique email| VAL1["Laravel validation"]
  C2 -->|update user| U[(users table)]
  U --> OUT1["Back with success"]

  A -->|POST /settings/password| R3["routes/web.php"]
  R3 --> C3["SettingsController.updatePassword"]
  C3 -->|validate current_password + strong password| VAL2["Laravel validation"]
  C3 -->|hash + update| U2[(users table)]
  U2 --> OUT2["Back with success"]
```

Key code:
- Controller: [app/Http/Controllers/SettingsController.php](../app/Http/Controllers/SettingsController.php)
- View: [resources/views/settings/index.blade.php](../resources/views/settings/index.blade.php)

---

## Source Index

- Routes: [routes/web.php](../routes/web.php)
- Controllers: [app/Http/Controllers](../app/Http/Controllers)
- Models: [app/Models](../app/Models)
- Policies: [app/Policies](../app/Policies)
- Notification service: [app/Services/NotificationService.php](../app/Services/NotificationService.php)
