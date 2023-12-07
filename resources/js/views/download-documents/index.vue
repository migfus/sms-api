<template>
  <div class="bg-white shadow sm:rounded-xl max-w-screen-xl mx-auto mt-3 mb-3 p-6">
    <h1 class="font-bold text-gray-600">Non-Fillable Documents</h1>
  </div>

  <div class="bg-white shadow sm:rounded-xl max-w-screen-xl mx-auto mb-6">
    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">
      <div v-for="(row, rowIdx) in nonFillable" :key="row.title" :class="[false ? 'rounded-tl-lg rounded-tr-lg sm:rounded-tr-none' : '', rowIdx === 1 ? 'sm:rounded-tr-lg' : '', rowIdx === nonFillable.length - 2 ? 'sm:rounded-bl-lg' : '', rowIdx === nonFillable.length - 1 ? 'rounded-bl-lg rounded-br-lg sm:rounded-bl-none' : '', 'relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500']">
        <div>
          <span :class="[row.iconBackground, row.iconForeground, 'rounded-lg inline-flex p-3 ring-4 ring-white']">
            <component :is="row.icon" class="h-6 w-6" aria-hidden="true" />
          </span>
        </div>
        <div class="mt-8">
          <h3 class="text-lg font-medium">
            <div class="focus:outline-none">
              <!-- Extend touch target to entire panel -->
              <!-- <span class="absolute inset-0" aria-hidden="true" /> -->
              {{ row.title }}
            </div>
          </h3>
          <p class="mt-2 text-sm text-gray-500">{{ row.desc }} </p>
        </div>

        <div class="flex justify-end gap-2 mt-4">
          <a v-if="row.download_type.excel" :href="row.download_type.excel" target="_blank">
            <AppButton>Download XLSX</AppButton>
          </a>
          <a v-if="row.download_type.word" :href="row.download_type.word" target="_blank">
            <AppButton color="info">Download DOCX</AppButton>
          </a>
          <a v-if="row.download_type.pdf" :href="row.download_type.pdf" target="_blank">
            <AppButton color="danger">Download PDF</AppButton>
          </a>
        </div>

      </div>

    </div>

  </div>



  <div class="bg-white shadow sm:rounded-xl max-w-screen-xl mx-auto my-3 p-6">
    <h1 class="font-bold text-gray-600">Fillable Documents</h1>
  </div>

  <div class="bg-white shadow sm:rounded-xl max-w-screen-xl mx-auto mb-6">
    <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 sm:grid sm:grid-cols-2 sm:gap-px sm:divide-y-0">
      <div v-for="(row, rowIdx) in fillable" :key="row.title" :class="[false ? 'rounded-tl-lg rounded-tr-lg sm:rounded-tr-none' : '', rowIdx === 1 ? 'sm:rounded-tr-lg' : '', rowIdx === fillable.length - 2 ? 'sm:rounded-bl-lg' : '', rowIdx === fillable.length - 1 ? 'rounded-bl-lg rounded-br-lg sm:rounded-bl-none' : '', 'relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary-500']">
        <div>
          <span :class="[row.iconBackground, row.iconForeground, 'rounded-lg inline-flex p-3 ring-4 ring-white']">
            <component :is="row.icon" class="h-6 w-6" aria-hidden="true" />
          </span>
        </div>
        <div class="mt-8">
          <h3 class="text-lg font-medium">
            <div class="focus:outline-none">
              <!-- Extend touch target to entire panel -->
              <!-- <span class="absolute inset-0" aria-hidden="true" /> -->
              {{ row.title }}
            </div>
          </h3>
          <p class="mt-2 text-sm text-gray-500">{{ row.desc }} </p>
        </div>

        <div class="flex justify-end gap-2 mt-4">
          <a v-if="row.download_type.excel" :href="row.download_type.excel" target="_blank">
            <AppButton>Download XLSX</AppButton>
          </a>
          <a v-if="row.download_type.word" :href="row.download_type.word" target="_blank">
            <AppButton color="info">Download DOCX</AppButton>
          </a>
          <a v-if="row.download_type.pdf" :href="row.download_type.pdf" target="_blank">
            <AppButton color="danger">Download PDF</AppButton>
          </a>
        </div>

      </div>

    </div>

  </div>
</template>

<script setup lang='ts'>
import {
  AcademicCapIcon,
  BanknotesIcon,
  CheckBadgeIcon,
  ClockIcon,
  ReceiptRefundIcon,
  UsersIcon,
} from '@heroicons/vue/24/outline'
import AppButton from '@/components/form/AppButton.vue'

type TDownload = {
  title: string
  iconForeground: string
  iconBackground: string
  icon: any
  desc: string
  download_type: {
    pdf?: string
    word?: string
    excel?: string
  }
}

const url_root = '/assets'

const nonFillable = <TDownload[]>[
  {
    title: 'Checklist Requirements - for Job Order',
    icon: ClockIcon,
    desc: `A Checklist requirements for `,
    iconForeground: 'text-teal-700',
    iconBackground: 'bg-teal-50',
    download_type: {
      word: `${url_root}/List of Requirement lenghtwise jo.docx`,
    }
  },
  {
    title: 'Checklist Requirements - for Contractual of Service (Faculty)',
    icon: CheckBadgeIcon,
    desc: 'To ensure the physical fit of the applicant, it is required by the government-hiring applications. This form may required an additional attachement for support and it can depends on the requirements of the Job',
    iconForeground: 'text-purple-700',
    iconBackground: 'bg-purple-50',
    download_type: {
      word: `${url_root}/List of Requirement lenghtwise jo.docx`,
    }
  },
  // {
  //   title: 'Schedule a one-on-one',
  //   icon: UsersIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-sky-700',
  //   iconBackground: 'bg-sky-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
  // {
  //   title: 'Payroll',
  //   icon: BanknotesIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-yellow-700',
  //   iconBackground: 'bg-yellow-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
  // {
  //   title: 'Submit an expense',
  //   icon: ReceiptRefundIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-rose-700',
  //   iconBackground: 'bg-rose-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
  // {
  //   title: 'Training',
  //   icon: AcademicCapIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-primary-700',
  //   iconBackground: 'bg-primary-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
]

const fillable = <TDownload[]>[
  {
    title: 'Personal Data Sheet (PDS)',
    icon: ClockIcon,
    desc: `Required by the government-hiring application (Civil Service), and it should contain any basic personal data of the applicant. The input data may required a proof as an additional attachement for PDS.`,
    iconForeground: 'text-teal-700',
    iconBackground: 'bg-teal-50',
    download_type: {
      pdf: `${url_root}/PDS_CS_Form_No_212_Revised2017.pdf`,
      excel: `${url_root}/CS Form No. 212 Personal Data Sheet revised.xlsx`,
    }
  },
  {
    title: 'Medical Certificate',
    icon: CheckBadgeIcon,
    desc: 'To ensure the physical fit of the applicant, it is required by the government-hiring applications. This form may required an additional attachement for support and it can depends on the requirements of the Job',
    iconForeground: 'text-purple-700',
    iconBackground: 'bg-purple-50',
    download_type: {
      excel: `${url_root}/medical.xls`,
    }
  },
  // {
  //   title: 'Schedule a one-on-one',
  //   icon: UsersIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-sky-700',
  //   iconBackground: 'bg-sky-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
  // {
  //   title: 'Payroll',
  //   icon: BanknotesIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-yellow-700',
  //   iconBackground: 'bg-yellow-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
  // {
  //   title: 'Submit an expense',
  //   icon: ReceiptRefundIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-rose-700',
  //   iconBackground: 'bg-rose-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
  // {
  //   title: 'Training',
  //   icon: AcademicCapIcon,
  //   desc: 'Download PDS',
  //   iconForeground: 'text-primary-700',
  //   iconBackground: 'bg-primary-50',
  //   download_type: {
  //     pdf: '#'
  //   }
  // },
]
</script>
