interface ImportMetaEnv {
    readonly VITE_FEDAPAY_PUBLIC_KEY: string
    // more env variables...
  }
  
  interface ImportMeta {
    readonly env: ImportMetaEnv
  }