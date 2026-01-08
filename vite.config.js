import { defineConfig } from 'vite';

export default defineConfig({
  plugins: [],
  build: {
    manifest: 'manifest.json',
    outDir: 'public/build',
    emptyOutDir: false,
    rollupOptions: {
      input: './resources/js/app.js'
    }
  },
  publicDir: false,
  server: {
    port: 5173,
  }
});