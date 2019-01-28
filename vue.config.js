module.exports = {
    devServer: {
        proxy: {
            '^/api': {
                target: 'http://localhost:9090',
                ws: true,
                changeOrigin: true
            },
        }
    },
    pluginOptions: {
        browserSync: {
            // ... BrowserSync options
        }
    }
}