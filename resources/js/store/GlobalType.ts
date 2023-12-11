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

export type TGPersonal = {
  id: number
  last_name: string
  first_name: string
  mid_name: string
  ext_name: string

  civil_status_id: number
  civil_status: {
    name: string
  }
  birth_day: Date
  birth_place_id: number
  blood_type_id: number
  blood_type: {
    name: string
  }
  sex: boolean
  height: number
  weight: number
  address_id: number
  address_barangay: string
  address_street: string
  address: string

  gsis_id?: string
  pagibig_id?: string
  // philhealth_id?: string
  tin_id?: string
  philhealth_id?: string
  sss_id?: string
  agency_id?: string
  mobile_numbers: {
    number: number
  }[]

}

export type TGEducation = {
  id: number
  level: number
  education_level: { name: string }
  school: string
  degree: string
  from: Date
  to: Date
  scholarship: string
  honors: string
}

export type TGEligibility = {
  name: string
  address_id: number
  rating: number
  exam_date: Date
  validity_date: Date
  number: string
}

export type TGExperience = {
  position: string
  company: string
  from: Date
  to?: Date
  salary: number
  salary_type_id: number
  salary_type: {
    name: string
  }
  sg: number
  work_status_id: number
  work_status: {
    name: string
  }
  is_government: boolean
}

export type TGVoluntary = {
  name: string
  from: Date
  to: Date
  hours: number
  position: string
}

export type TGSeminar = {
  name: string
  from: Date
  to: Date
  hours: number
  seminar_type_id: number
  seminar_type: { name: string }
  sponsor: string
}


export type TGPost = {
  id: number
  title: string
  cover: string
  category: { name: string }
  content: string
  user: {
    id: number
    email: string
    avatar: string
  }
  created_at: string
}
