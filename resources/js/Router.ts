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
          component: () => import('@/views/job-listing/[id].vue'),
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
          name: "profile",
          component: () => import("@/views/dashboard/profile.vue"),
          meta: {
            sideBar: true,
            title: "Dashboard",
            auth: true,
          },
        },

        {
          path: "documents",
          name: "documents",
          component: () => import("@/views/dashboard/documents/index.vue"),
          meta: {
            sideBar: true,
            title: "Dashboard",
            auth: true,
            resource: 'profile',
          },
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
