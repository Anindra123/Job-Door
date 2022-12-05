import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
// import react from "@vitejs/plugin-react";
import path from "path";
export default defineConfig({
    plugins: [
        laravel(["resources/sass/app.scss", "resources/js/app.js"]),
        // react(),
        {
            name: "blade",
            handleHotUpdate({ file, server }) {
                if (file.endsWith(".blade.php")) {
                    server.ws.send({
                        type: "full-reload",
                        path: "*",
                    });
                }
            },
        },
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
        },
    },
});
