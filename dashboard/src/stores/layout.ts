import { reactive, readonly } from 'vue'

const isMobile = () => window.innerWidth < 768

const state = reactive({
  menuExpanded: !isMobile(),
})

const toggleMenuVisibility = () => {
  state.menuExpanded = !state.menuExpanded
}

const setMenuVisibility = (visible: boolean) => {
  state.menuExpanded = isMobile() ? visible : true
}

export const useLayoutStore = () => (
  { state: readonly(state), toggleMenuVisibility, setMenuVisibility }
)
