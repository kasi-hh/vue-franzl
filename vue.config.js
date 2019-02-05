module.exports = {
    configureWebpack:{
        plugins:[
            {
                apply:(compiler) => {
                    console.log('compiler')
                }
            }
        ]
    },
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
    ,
    /*
    chainWebpack: (config) => {
        if (config.plugins.has('copy')){
            const copy = config.plugin('copy')
            copy.tap(([options])=> {
                options[0].ignore.push('images/');
            });
        }
    },
    /*
    chainwebpack: config => {
        config.plugin('copy').tap([options] => {
            options[0].ignore.push('some/glob')
            return [options]
        })
    }
    */
}