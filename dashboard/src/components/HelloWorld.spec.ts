import { mount } from '@vue/test-utils'
import Component from './HelloWorld.vue'

it('renders header text', () => {
  const msg = 'Hello test'
  const wrapper = mount(Component, {
    props: {
      msg,
    },
  })

  expect(wrapper.find('h1').text()).toBe(msg)
})
