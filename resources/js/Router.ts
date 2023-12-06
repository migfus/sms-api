import { createRouter, createWebHistory, isNavigationFailure, NavigationFailureType } from "vue-router"
import { useAuthStore } from "@/store/@auth/AuthStore"
import { usePreLoader } from "@/store/system/PreLoader"
import ability from '@/Ability'

import { useFaqPublicStore } from "@/store/@public/FaqPublicStore"

const router = createRouter({
  history: createWebHistory(),
  routes: [
    // NOTE PAGES
    {
      path: "/",
      name: 'home',
      component: () => import('@/views/index/index.vue'),
      meta: {
        title: 'Home',
      }
    },

    {
      path: "/about",
      name: 'about',
      component: () => import('@/views/about/index.vue'),
      meta: {
        title: 'About',
      }
    },

    {
      path: '/job-listing',
      children: [
        {
          path: '',
          name: 'job-listing',
          component: () => import('@/views/job-listing/index.vue'),
          meta: {
            title: 'Job Listing'
          },
        },

        {
          path: ':id',
          name: 'job-view',
          component: () => import('@/views/job-listing/[id]/index.vue'),
          meta: {
            title: 'Job Listing'
          },
        }
      ]
    },

    {
      path: '/calendar',
      name: 'calendar',
      component: () => import('@/views/calendar.vue'),
      meta: {
        title: 'Calendar'
      }
    },

    {
      path: '/faqs',
      name: 'faqs',
      component: () => import('@/views/faqs/index.vue'),
      meta: {
        title: 'FAQs'
      }
    },

    {
      path: '/news',
      children:[
        {
          path: '',
          name: 'news',
          component: () => import('@/views/news/index.vue'),
          meta: {
            title: 'News & Updates'
          },
        },

        {
          path: ':id',
          name: 'post',
            component: () => import('@/views/news/[id].vue'),
            meta: {
              title: 'Post'
            }
        },
      ]
    },

    {
      path: '/terms-agreement',
      name: 'terms-agreement',
      component: () => import('@/views/terms-agreement.vue'),
      meta: {
        title: 'Terms & Agreement'
      }
    },


    // NOTE AUTH =================================================================
    {
      path: "/login",
      name: "login",
      component: () => import("@/views/login.vue"),
      meta: {
        title: "Login",
      },
    },

    {
      path: "/register",
      children: [
        {
          path: ``,
          name: "register",
          component: () => import("@/views/register/index.vue"),
          meta: {
            title: "Register",
          },
        },
        {
          path: `fill`,
          name: `fill-register`,
          component: () => import("@/views/register/fill.vue"),
          meta: {
            title: "Fill Up",
          },
        }
      ]

    },

    {
      path: "/forgot",
      name: "forgot",
      component: () => import("@/views/forgot.vue"),
      meta: {
        title: "Forgot Password",
      },
    },
    {
      path: "/recovery",
      name: "recovery",
      component: () => import("@/views/recovery.vue"),
      meta: {
        title: "Recover Account",
      },
    },

    // NOTE DASHBOARD
    {
      path: "/dashboard",
      children: [
        {
          path: '',
          name: "dashboard",
          component: () => import("@/views/dashboard/index.vue"),
          meta: {
            sideBar: true,
            title: "Dashboard",
            auth: true,
          },
        },

        {
          path: "profile",
          children: [
            {
              path: '',
              name: "profile",
              component: () => import("@/views/dashboard/profile/index.vue"),
              meta: {
                sideBar: true,
                title: "Dashboard",
                auth: true,
              },
            },
            {
              path: 'education',
              name: "profile-education",
              component: () => import("@/views/dashboard/profile/education.vue"),
              meta: {
                sideBar: true,
                title: "Education",
                auth: true,
              },
            },
            {
              path: 'eligibilities',
              name: "profile-eligibilities",
              component: () => import("@/views/dashboard/profile/eligibilities.vue"),
              meta: {
                sideBar: true,
                title: "Eligibilities",
                auth: true,
              },
            },
            {
              path: 'experience',
              name: "profile-experience",
              component: () => import("@/views/dashboard/profile/experience.vue"),
              meta: {
                sideBar: true,
                title: "Experience",
                auth: true,
              },
            },
            {
              path: 'voluntaries',
              name: "profile-voluntaries",
              component: () => import("@/views/dashboard/profile/voluntaries.vue"),
              meta: {
                sideBar: true,
                title: "Voluntaries",
                auth: true,
              },
            },
            {
              path: 'seminars',
              name: "profile-seminars",
              component: () => import("@/views/dashboard/profile/seminars.vue"),
              meta: {
                sideBar: true,
                title: "Seminars",
                auth: true,
              },
            },
            {
              path: 'skills',
              name: "profile-skills",
              component: () => import("@/views/dashboard/profile/skills.vue"),
              meta: {
                sideBar: true,
                title: "Skills",
                auth: true,
              },
            },
            {
              path: 'mobile',
              name: "profile-mobile",
              component: () => import("@/views/dashboard/profile/mobile.vue"),
              meta: {
                sideBar: true,
                title: "Mobile Numbers",
                auth: true,
              },
            },
            {
              path: 'documents',
              name: "profile-documents",
              component: () => import("@/views/dashboard/profile/documents.vue"),
              meta: {
                sideBar: true,
                title: "Uploaded Documents",
                auth: true,
              },
            },
          ]

        },

        {
          path: "users",
          children: [
            {
              path: '',
              name: "users",
              component: () => import("@/views/dashboard/users/index.vue"),
              meta: {
                sideBar: true,
                title: "Users",
                auth: true,
                resource: 'user',
              },
            },
            {
              path: ":id",
              name: "user",
              component: () => import("@/views/dashboard/users/[id].vue"),
              meta: {
                sideBar: true,
                title: "Users",
                auth: true,
                resource: 'user',
              },
            },
          ]

        },
      ]
    },

    // NOTE ACCOUNT SETTINGS
    {
      path: '/account',
      children: [
        {
          name: 'account',
          path: '',
          component: () => import('@/views/account/index.vue'),
          meta: {
            title: 'Account Settings',
            auth: true,
            sideBar: true
          }
        },
        {
          name: 'account-password',
          path: '/password',
          component: () => import('@/views/account/password.vue'),
          meta: {
            title: 'Update Password',
            auth: true,
            sideBar: true
          }
        }

      ]

    },


    // NOTE OTHER
    {
      path: "/:pathMatch(.*)*",
      name: 'error',
      component: () => import("@/views/[error].vue"),
      meta: {
        title: "Page not Found!",
      },
    },
  ],
});


const TITLE = "CMU HRMO"
router.beforeEach(async (to, from, next) => {
  const $load = usePreLoader()
  const $auth = useAuthStore()

  $load.config.loading = true
  $load.config.to = to.name

  $auth.UpdateAbility()

  const canNavigate = to.matched.some(row => {
    if(row.meta.resource) {
      // @ts-ignore
      return ability.can(row.meta.action || 'index', row.meta.resource)
    }
    return true;
  })

  // const $auth = useAuthStore();

  // if ($auth.token == "" && to.name !== "login") {
  //   return { name: "login" };
  // }

  // if(to.meta.auth && $auth.token == '' && to.meta.name != 'login') {
  //   return { name: 'login'};
  //   // return false
  // }

  // if(to.meta.role) {
  //   if($auth.content.auth.role == 2) {

  //   }
  //   else if(to.meta.role != $auth.content.auth.role && to.meta.name != 'error') {
  //     // return { name: 'error'}
  //     return false
  //   }
  // }
  if(!canNavigate) {
    next(new Error('Route Disabled (no permission)'))
  }

  next()
});

router.afterEach((to, from, failure) => {

  const $load = usePreLoader()
  $load.config.loading = false

  document.title = to.meta.title ? `${to.meta.title} | ${TITLE}` : "";
})

export default router;
