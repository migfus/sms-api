import { useAddressStore } from '@/store/system/AddressStore'
const $address = useAddressStore()

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

export const sexIDToText = (sex: boolean) => sex ? 'Male' : 'Female'

export const addressIDToFull = (id: number) => {
  for (let i = 0; $address.content.length > i; i++) {
    const province = $address.content[i];
    for (let f = 0; province.cities.length > f; f++) {
      if (province.cities[f].id == id) {
        return `${province.cities[f].name}, ${province.name} ${province.cities[f].zipcode}`;
      }
    }
  }
  return null;
}

export const cityIDToProvinceID = (id: number) => {
  for (let i = 0; $address.content.length > i; i++) {
    const province = $address.content[i];
    for (let f = 0; province.cities.length > f; f++) {
      if (province.cities[f].id == id) {
        return province.id
      }
    }
  }
  return -1;
}

export const mobileToFormatted = (number: string) => {
  return `+63 ${number.substring(0,3)} ${number.substring(3,6)} ${number.substring(6, number.length)}`
}


// SECTION NUMBER CONVERTER
export const NumberAddComma = (num: number)  => {
  if(num) {
      let _num = Number(num).toFixed(2);
      return _num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
  return '0.00'
}

export const FileExtension = (filename: string, filenamOnly = false) => {
  if(filenamOnly) {
    return filename.replace(/\.[^/.]+$/, "")
  }
  return filename.substring(filename.lastIndexOf('.')+1, filename.length) || filename;
}

export const FileExtensionPreview = (filename: string, url = null) => {
  let ext =  filename.substring(filename.lastIndexOf('.')+1, filename.length) || filename;

  switch(ext) {
    case 'xlsx':
      return 'https://techcommunity.microsoft.com/t5/image/serverpage/image-id/375416i783713B05CAD4A92/image-size/original?v=v2&px=-1'
    case 'docx':
      return 'https://logos-world.net/wp-content/uploads/2020/03/Microsoft-Word-Logo.png'
    case 'pdf':
      return 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/1667px-PDF_file_icon.svg.png'
    case 'png':
      return url
    case 'jpg':
      return url
    case 'gif':
      return url
    default:
      return 'https://e7.pngegg.com/pngimages/1022/1019/png-clipart-question-mark-logo-question-mark-in-circle-icons-logos-emojis-question-marks.png'
  }
}


export const FullName = (name: { last_name: string, first_name: string, mid_name?: string, ext_name?: string}) => {
  return `${name.last_name}, ${name.first_name} ${name.mid_name ?? ''} ${name.ext_name ?? ''}`
}
