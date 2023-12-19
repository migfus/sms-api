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
