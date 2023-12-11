<template>
  <AppButton @click="GeneratePDS()" :loading="$pds.config.buttonLoading">Generate PDS</AppButton>
</template>

<script setup lang="ts">
import { useGeneratePdsStore } from '@/store/@applicant/GeneratePdsStore'
import { useAddressStore } from '@/store/system/AddressStore'
import { PDFDocument, rgb, StandardFonts } from 'pdf-lib'
import download from 'downloadjs'
import moment from 'moment'

import AppButton  from '@/components/form/AppButton.vue'

const $pds = useGeneratePdsStore()
const $address = useAddressStore()

async function GeneratePDS() {
  $pds.config.buttonLoading = true
  await $pds.GetAPI()

  const pdfUrl = await fetch('http://127.0.0.1:8000/assets/PDS_CS_Form_No_212_Revised2017.pdf').then(res => res.arrayBuffer())
  const pngUrl = await fetch('https://cdn-icons-png.flaticon.com/512/33/33281.png').then(res => res.arrayBuffer())

  const pdfDoc = await PDFDocument.load(pdfUrl)
  const font =   await pdfDoc.embedFont(StandardFonts.TimesRoman)
  const checkImg = await pdfDoc.embedPng(pngUrl)

  const pages = pdfDoc.getPages()
  const firstPage = pages[0]
  const smStyle = {
    size: 8,
    font: font,
    color: rgb(0.95, 0.1, 0.1),
  }
  const mdStyle = {
    size: 10,
    font: font,
    color: rgb(0.95, 0.1, 0.1),
  }

  FirstPage(firstPage, mdStyle, smStyle, checkImg)

  const pdfBytes = await pdfDoc.save()

  download(pdfBytes, "pds.pdf", "application/pdf");
  $pds.config.buttonLoading = false
}

function FirstPage(firstPage, mdStyle, smStyle, checkImg) {
  // SECTION FIRST PAGE
  firstPage.drawText($pds.content.personal.last_name,         {x: 130, y: 802, ...mdStyle}) // surname
  firstPage.drawText($pds.content.personal.first_name,        {x: 130, y: 783, ...mdStyle}) // firstname
  firstPage.drawText($pds.content.personal.mid_name ?? 'N/A', {x: 130, y: 764, ...mdStyle}) // midname
  firstPage.drawText($pds.content.personal.ext_name ?? 'N/A', {x: 465, y: 783, ...smStyle}) // ext_name

  firstPage.drawText(moment($pds.content.personal.birth_day).format('MM/DD/YYYY'), {x: 130, y: 745, ...mdStyle}) // bday
  firstPage.drawText($address.addressIDToFull($pds.content.personal.birth_place_id), {x: 130, y: 715, ...smStyle}) // bday

  if($pds.content.personal.sex) {
    firstPage.drawImage(checkImg, {x: 135, y: 693, width: 10, height: 10}) // Male
  } else {
    firstPage.drawImage(checkImg, {x: 187, y: 693, width: 10, height: 10}) // Female
  }

  switch($pds.content.personal.civil_status.name) {
    case 'Single':
      firstPage.drawImage(checkImg, {x: 135, y: 675, width: 10, height: 10}); break
    case 'Married':
      firstPage.drawImage(checkImg, {x: 187, y: 675, width: 10, height: 10}); break
    case 'Widowed':
      firstPage.drawImage(checkImg, {x: 135, y: 663, width: 10, height: 10}); break
    case 'Separated':
      firstPage.drawImage(checkImg, {x: 187, y: 663, width: 10, height: 10}); break
    default:
      firstPage.drawImage(checkImg, {x: 135, y: 650, width: 10, height: 10}) // Others
      firstPage.drawText($pds.content.personal.civil_status.name, {x: 176, y: 651, ...smStyle})
  }

  firstPage.drawText(
    $pds.content.personal.height.toString(),
    {x: 130, y: 629, ...mdStyle}
  ) // height
  firstPage.drawText(
    $pds.content.personal.weight.toString(),
    {x: 130, y: 612, ...mdStyle}
  ) // weight
  firstPage.drawText(
    $pds.content.personal.blood_type.name,
    {x: 130, y: 593, ...mdStyle}
  ) // blood type

  // DEBUG Add database
  firstPage.drawText(
    $pds.content.personal.gsis_id ?? 'N/A',
    {x: 130, y: 570, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.pagibig_id ?? 'N/A',
    {x: 130, y: 549, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.philhealth_id ?? 'N/A',
    {x: 130, y: 530, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.sss_id ?? 'N/A',
    {x: 130, y: 512, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.tin_id ?? 'N/A',
    {x: 130, y: 496, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.agency_id ?? 'N/A',
    {x: 130, y: 480, ...mdStyle}
  )

  // NOTE CITIZENSHIP
  firstPage.drawImage(
    checkImg,
    {x: 380, y: 742, width: 10, height: 10}
  ) // Check for Filipino
  // NOTE ADDRESS
  firstPage.drawText(
    $pds.content.personal.address,
    {x: 335, y: 675, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.address_street,
    {x: 480, y: 675, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.address_barangay,
    {x: 480, y: 654, ...mdStyle}
  )
  firstPage.drawText(
    $address.addressIDToName($pds.content.personal.address_id),
    {x: 335, y: 633, ...mdStyle}
  )
  firstPage.drawText(
    $address.addressIDToProvinceName($pds.content.personal.address_id),
    {x: 480, y: 633, ...mdStyle}
  )
  firstPage.drawText(
    $address.addressIDToZip($pds.content.personal.address_id),
    {x: 335, y: 612, ...mdStyle}
  )

  firstPage.drawText(
    $pds.content.personal.address,
    {x: 335, y: 599, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.address_street,
    {x: 480, y: 599, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.address_barangay,
    {x: 480, y: 575, ...mdStyle}
  )
  firstPage.drawText(
    $address.addressIDToName($pds.content.personal.address_id),
    {x: 335, y: 554, ...mdStyle}
  )
  firstPage.drawText(
    $address.addressIDToProvinceName($pds.content.personal.address_id),
    {x: 480, y: 554, ...mdStyle}
  )
  firstPage.drawText(
    $address.addressIDToZip($pds.content.personal.address_id),
    {x: 335, y: 530, ...mdStyle}
  )

  firstPage.drawText(
    'N/A',
    {x: 335, y: 512, ...mdStyle}
  )
  firstPage.drawText(
    $pds.content.personal.mobile_numbers.map(row => `0${row.number}`).join(', '),
    {x: 335, y: 496, ...smStyle}
  )
  firstPage.drawText(
    $pds.content.user.email,
    {x: 335, y: 481, ...mdStyle}
  )


  // SECTION EDUCATION
  $pds.content.educations.map(row => {
    console.log(row)

    switch(row.education_level.name) {
      case 'Primary':
        firstPage.drawText(
          row.school,
          {x: 130, y: 145, ...smStyle}
        )
        firstPage.drawText(
          'Primary',
          {x: 242, y: 145, ...mdStyle}
        )
        firstPage.drawText(
          moment(row.from).format("MM/DD/YYYY"),
          {x: 372, y: 145, ...smStyle}
        )
        firstPage.drawText(
          row.to ? moment(row.to).format("MM/DD/YYYY") : 'On-Going',
          {x: 425, y: 145, ...smStyle}
        )
        firstPage.drawText(
          'N/A',
          {x: 465, y: 145, ...mdStyle}
        )
        firstPage.drawText(
          row.to ? moment(row.to).format('YYYY') : 'On-Going',
          {x: 505, y: 145, ...mdStyle}
        )
        firstPage.drawText(
          row.scholarship ?? 'N/A',
          {x: 552, y: 145, ...smStyle}
        )
        break
      case 'Secondary':
        firstPage.drawText(
          row.school,
          {x: 130, y: 123, ...smStyle}
        )
        firstPage.drawText(
          'Secondary',
          {x: 242, y: 123, ...mdStyle}
        )
        firstPage.drawText(
          moment(row.from).format('MM/DD/YYYY'),
          {x: 372, y: 123, ...smStyle}
        )
        firstPage.drawText(
          row.to ? moment(row.to).format('MM/DD/YYYY') : 'On-Going',
          {x: 425, y: 123, ...smStyle}
        )
        firstPage.drawText(
          'N/A',
          {x: 465, y: 123, ...mdStyle}
        )
        firstPage.drawText(
          row.to ? moment(row.to).format('YYYY') : 'On-Going',
          {x: 505, y: 123, ...mdStyle}
        )
        firstPage.drawText(
          row.scholarship,
          {x: 552, y: 123, ...smStyle}
        )
        break
    }
  })

  // else if(false) { // vocatinal
  //   firstPage.drawText(
  //     'School Name',
  //     {x: 130, y: 104, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'Primary',
  //     {x: 242, y: 104, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'from',
  //     {x: 373, y: 104, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'to',
  //     {x: 427, y: 104, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'N/A',
  //     {x: 465, y: 104, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     '2023',
  //     {x: 505, y: 104, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'CHED Scholarship',
  //     {x: 552, y: 104, ...smStyle}
  //   )
  // }
  // else if(false) { // college
  //   firstPage.drawText(
  //     'School Name',
  //     {x: 130, y: 85, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'Primary',
  //     {x: 242, y: 85, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'from',
  //     {x: 373, y: 85, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'to',
  //     {x: 427, y: 85, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'N/A',
  //     {x: 465, y: 85, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     '2023',
  //     {x: 505, y: 85, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'CHED Scholarship',
  //     {x: 552, y: 85, ...smStyle}
  //   )
  // }
  // else {
  //   firstPage.drawText(
  //     'School Name',
  //     {x: 130, y: 66, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'Primary',
  //     {x: 242, y: 66, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'from',
  //     {x: 373, y: 66, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'to',
  //     {x: 427, y: 66, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'N/A',
  //     {x: 465, y: 66, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     '2023',
  //     {x: 505, y: 66, ...mdStyle}
  //   )
  //   firstPage.drawText(
  //     'CHED Scholarship',
  //     {x: 552, y: 66, ...smStyle}
  //   )
  // }


  firstPage.drawText(moment().format('MM/DD/YYYY'),
    {x: 465, y: 40, ...mdStyle}
  )
}

function SecondPage(SecondPage, mdStyle) {

}
</script>
