import { shallowMount } from '@vue/test-utils'
import Component from './DataTable.vue'

it('renders', () => {
  const wrapper = shallowMount(Component, {
    props: {
      columns: [],
      data: [],
    },
  })
  expect(wrapper.html().length).toBeGreaterThan(50)
})

it('renders columns', () => {
  const wrapper = shallowMount(Component, {
    props: {
      columns: [
        { name: 'id', title: 'ID' },
        { name: 'demo', title: 'DemoTitle' },
      ],
      data: [],
    },
  })
  expect(wrapper.text()).toContain('DemoTitle')
})

it('renders data', () => {
  const wrapper = shallowMount(Component, {
    props: {
      columns: [
        { name: 'id', title: 'ID' },
        { name: 'demo', title: 'DemoTitle' },
      ],
      data: [
        { id: 10, demo: 'abc' },
        { id: 11, demo: 'xyz' },
      ],
    },
  })
  expect(wrapper.text()).toContain('xyz')
  expect(wrapper.text()).toContain('abc')
})

describe('slots', () => {
  it('renders default empty slot', () => {
    const wrapper = shallowMount(Component, {
      props: {
        columns: [],
        data: [],
      },
    })
    expect(wrapper.text()).toContain('No data found')
  })

  it('renders custom empty slot', () => {
    const wrapper = shallowMount(Component, {
      props: {
        columns: [],
        data: [],
      },
      slots: {
        empty: 'custom empty',
      },
    })
    expect(wrapper.text()).toContain('custom empty')
  })

  it('renders column with actions slot', () => {
    const wrapper = shallowMount(Component, {
      props: {
        columns: [
          { name: 'id', title: 'ID' },
          { name: 'actions', title: 'Actions' },
        ],
        data: [
          { id: 10, demo: 'abc' },
          { id: 11, demo: 'xyz' },
        ],
      },
      slots: {
        actions: 'custom actions',
      },
    })
    expect(wrapper.text()).toContain('custom actions')
  })
})
