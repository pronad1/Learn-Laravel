import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import VitePluginCopy from 'vite-plugin-copy';  // Import the plugin

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        VitePluginCopy({
            targets: [
                {
                    src: 'public/build/.vite/manifest.json',  // Source path
                    dest: 'public/build/',  // Destination path
                    rename: 'manifest.json', // Rename to the correct file
                },
            ],
            hook: 'writeBundle',  // Copy after Vite writes the bundle
        }),
    ],
    build: {
        outDir: 'public/build',  // Keep output folder as public/build
        manifest: true,          // Enable manifest generation
        emptyOutDir: true,       // Empty the build folder before new build
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',  // Main entry point
            },
        },
    },
});
