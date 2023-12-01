export type TGConfig = {
  contentLoading: boolean
  buttonLoading: boolean
  form?: string
}

export type TGQuery = {
  search: string
  filter?: string
  sort: 'ASC' | 'DESC'
  start?: Date
  end?: Date
}

export type TGAddress = {
  id: number
  name: string
  cities: Array<{
      id: number
      name: string
      zipcode: number
  }>
}

export type TGAuth = {
    id: number
    avatar: string
    email: string
    created_at: string
    roles: Array<{
      name: string
    }>
    person: {
      addres: string
      address_id: number
      birth_day: string
      birth_place_id: number
      blood_type_id: number
      civil_status_id: number
      created_at: string
      ext_name: string
      last_name: string
      first_name: string
      mid_name: string
      gsis_id: string
      height: number
      id: number
      pagibig_id: string
      sex: boolean
      tin_id: string
      weight: string
  }
}
