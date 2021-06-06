import { shallowMount } from '@vue/test-utils'
import Component from './Card.vue'

it('renders slot', () => {
  const slot = 'demoslot'

  const wrapper = shallowMount(Component, {
    slots: {
      default: slot,
    },
  })

  expect(wrapper.html()).toContain(slot)
})
