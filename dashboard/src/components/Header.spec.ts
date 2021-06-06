import { shallowMount } from '@vue/test-utils'
import Component from './Header.vue'

const wrapper = shallowMount(Component)

it('renders', () => {
  expect(wrapper.html().length).toBeGreaterThan(100)
})

it('renders logo', () => {
  expect(wrapper.find('[data-test="header-logo"]').exists()).toBe(true)
})

it('renders notifications', () => {
  expect(wrapper.find('[data-test="header-notifications"]').exists()).toBe(true)
})

it('renders user', () => {
  expect(wrapper.find('[data-test="header-user"]').exists()).toBe(true)
})
