import { shallowMount } from '@vue/test-utils'
import Component from './StarsParallax.vue'

it('renders', () => {
  const wrapper = shallowMount(Component)
  expect(wrapper.html().length).toBeGreaterThan(20)
})
