import { reactive } from 'vue'

export const store = reactive({
  cookies: {
    acknowledged: false,
  },

  tabs: [{ activeTab: '' }],
})
