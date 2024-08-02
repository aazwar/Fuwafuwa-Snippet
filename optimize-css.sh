#npx tailwindcss -i css/styles.css -o css/styles.opt.min.css --minify $@
#cat css/styles.css | npx postcss -o css/styles.opt.min.css --minify
cat css/styles.css | npx postcss -o themes/tailwind/styles.min.css --minify