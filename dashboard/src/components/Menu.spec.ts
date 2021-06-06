import { shallowMount } from '@vue/test-utils'
import Component from './Menu.vue'

it('renders', () => {
  const wrapper = shallowMount(Component)
  expect(wrapper.html().length).toBeGreaterThan(100)
})
