import fs from 'node:fs/promises';
import path from 'node:path';
import process from 'node:process';
import { chromium } from 'playwright';

const projectRoot = process.cwd();
const outDir = path.join(projectRoot, 'docs', 'screenshots');

function getArg(name, fallback) {
  const prefix = `--${name}=`;
  const arg = process.argv.find((a) => a.startsWith(prefix));
  return arg ? arg.slice(prefix.length) : fallback;
}

const baseUrl = getArg('baseUrl', 'http://127.0.0.1:8000');
const theme = getArg('theme', 'light');

const pages = [
  { name: 'landing', url: `${baseUrl}/`, file: 'landing.png' },
  { name: 'login', url: `${baseUrl}/login`, file: 'login.png' },
  { name: 'register', url: `${baseUrl}/register`, file: 'register.png' },
];

await fs.mkdir(outDir, { recursive: true });

const browser = await chromium.launch({ headless: true });
const context = await browser.newContext({
  viewport: { width: 1440, height: 900 },
  deviceScaleFactor: 1,
});

const page = await context.newPage();

for (const p of pages) {
  try {
    await page.goto(p.url, { waitUntil: 'networkidle', timeout: 60000 });

    if (theme === 'dark') {
      await page.emulateMedia({ colorScheme: 'dark' });
    }

    // Give animations a moment to settle.
    await page.waitForTimeout(1200);

    const outPath = path.join(outDir, p.file);
    await page.screenshot({ path: outPath, fullPage: true });
    // eslint-disable-next-line no-console
    console.log(`Saved: ${path.relative(projectRoot, outPath)} (${p.url})`);
  } catch (err) {
    // eslint-disable-next-line no-console
    console.error(`Failed: ${p.name} (${p.url})`);
    // eslint-disable-next-line no-console
    console.error(err);
  }
}

await browser.close();
