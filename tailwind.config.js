// import fs from 'fs';
// import parentTwConfig from '../../../tailwind.config';

// const blocklist = JSON.parse(fs.readFileSync('../../../blocklist.json', 'utf-8')) ?? [];

/** @type {import('tailwindcss').Config} */
module.exports = {
  // ...parentTwConfig,
  content: [
    './Templates/**/*.blade.php',
    './Controllers/**/*.php',
  ],
  // blocklist: [...(parentTwConfig.blocklist ?? []), ...blocklist],
};
