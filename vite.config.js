import path from "node:path"
import react from "@vitejs/plugin-react"
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                    

                    'resources/css/app.css',
                    'resources/css/editor.css',
                    'resources/css/loader.css',
                    'resources/css/role_loader.css',
                    'resources/css/show_article_loader.css',
                    'resources/css/showContent.css',

                    'resources/js/bootstrap.js',
                    'resources/js/app.js',

                    'resources/ts/helpers.ts',
                    'resources/ts/htmx.ts',
                    'resources/ts/index.ts',

                    'resources/webradio_frontend/blog/Editor.tsx',
                    'resources/webradio_frontend/blog/EditorComponent.tsx',
                    'resources/webradio_frontend/blog/removeEditorItem.ts',

                    'resources/webradio_frontend/home/ActuCarousel.tsx',
                    'resources/webradio_frontend/home/ActuCarouselComponent.tsx',
                    'resources/webradio_frontend/home/CarouselCard.tsx',
                    'resources/webradio_frontend/home/homeComponents.tsx',
                    'resources/webradio_frontend/home/Menu.tsx',
                    'resources/webradio_frontend/home/MenuDeroulant.tsx',
                    'resources/webradio_frontend/home/OnlineRadio.tsx',
                    'resources/webradio_frontend/home/ShowEditorContent.tsx',
                    'resources/webradio_frontend/home/ShowEditorContentComponent.tsx',

                    'resources/webradio_frontend/service/PaymentComponent.tsx',
                    
                    'resources/webradio_frontend/shared/DeleteButton.ts',
                    'resources/webradio_frontend/shared/FileUploader.tsx',
                    'resources/webradio_frontend/shared/FileUploaderComponent.tsx',
                    'resources/webradio_frontend/shared/ScrollTo.tsx',
                    'resources/webradio_frontend/shared/ScrollToComponent.tsx',
                    'resources/webradio_frontend/shared/Toast.tsx',
                    'resources/webradio_frontend/shared/ToastComponent.tsx'


                  ],
            refresh: true,
        }),

        react()
    ],
    resolve: {
        alias: {
          "@": path.resolve(__dirname, "./src"),
        },
      },
});
