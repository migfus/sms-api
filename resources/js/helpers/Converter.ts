export const formatBytes = (bytes: number, decimals:number = 2) => {
  if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

export const convertFileOrExt = (filename: string, extension:boolean = false) => {
  if(extension) {
    return filename.split('.').pop();
  }
  else {
    return filename.split('.').slice(0, -1).join('.')
  }
}

export const convertName = (person: {last_name: string, first_name: string, mid_name: string, ext_name: string}) => {
  return `${person.last_name}, ${person.first_name} ${person.mid_name} ${person.ext_name}`
}
