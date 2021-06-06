import { defineConfig } from 'vite'
import { resolve } from 'path'
import vue from '@vitejs/plugin-vue'
import ViteIcons, { ViteIconsResolver } from 'vite-plugin-icons'
import ViteComponents from 'vite-plugin-components'
import ViteSvg from 'vite-plugin-vue-svg'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    ViteComponents({
      customComponentResolvers: ViteIconsResolver({
        componentPrefix: '',
        enabledCollections: ['mdi'],
      }),
    }),
    ViteIcons(),
    ViteSvg({
      defaultExport: 'component',
      svgoConfig: {
        plugins: [
          { removeXMLNS: true },
          { cleanupIDs: { force: true } },
          { removeRasterImages: true },
          { inlineStyles: { onlyMatchedOnce: false } },
          { removeStyleElement: true },
          { removeScriptElement: true },
          { removeOffCanvasPaths: true },
          { removeViewBox: false },
          { removeAttrs: { attrs: '(data-name|class|style)' } },
        ],
      },
    }),
  ],
  resolve: {
    alias: {
      '@': resolve(__dirname, '/src'),
    },
  },
  build: {
    assetsInlineLimit: 10000,
  },
})
