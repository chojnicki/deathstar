import { shallowMount } from '@vue/test-utils'
import Component from './MenuItem.vue'

it('renders', () => {
  const wrapper = shallowMount(Component, {
    props: {
      name: '404',
    },
  })
  expect(wrapper.html().length).toBeGreaterThan(100)
})

it('does not render notification circle when not needed', () => {
  const wrapper = shallowMount(Component, {
    props: {
      name: '404',
    },
  })
  expect(wrapper.find('[data-test="menu-notified-circle"]').exists()).toBe(false)
})

it('renders notification circle when needed', () => {
  const wrapper = shallowMount(Component, {
    props: {
      name: '404',
      notified: true,
    },
  })
  expect(wrapper.find('[data-test="menu-notified-circle"]').exists()).toBe(true)
})
