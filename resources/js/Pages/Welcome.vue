<script setup lang="ts" xmlns:Cache-Control="http://www.w3.org/1999/xhtml">
import {Head, Link} from '@inertiajs/inertia-vue3';
import xmasGift from '../../images/ChistmasGift.avif'
import turkey from '../../images/turkey.avif';
import {useHead} from "@vueuse/head";

interface Props {
  canLogin: Boolean,
  canRegister: Boolean,
}

const props = defineProps<Props>();

useHead({
  title: 'Mystery Drawing',
  meta:[
    {
      name: 'Mystery Drawing', content:() => 'Create mystery drawing lists for your friends!'
    }
  ]
})
</script>

<template>
  <Head title="Welcome"/>

  <div class="w-full mx-auto bg-gradient-to-r from-cyan-400 to-blue-300">
    <nav class="mx-auto w-full z-30">
      <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto mt-2 lg:mt-0 text-black p-4 lg:p-0 z-20">
          <ul class="list-reset flex justify-end flex-1 items-center">
            <li class="mr-3">
              <Link v-if="$page.props.user" :href="route('dashboard')"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                Dashboard
              </Link>
            </li>
            <li class="mr-3" v-if="canLogin && !$page.props.user">
              <Link :href="route('login')"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ">
                Log in
              </Link>
            </li>
            <li class="mr-3" v-if="canLogin && !$page.props.user">
              <Link :href="route('register')"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                Register
              </Link>
            </li>
          </ul>
        </div>
      </div>
      <hr class="border-b border-gray-100 opacity-25 my-0 py-0"/>
    </nav>
    <!--Hero-->
    <div class="pt-24 ">
      <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center ">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
          <p class="uppercase text-2xl tracking-loose w-full font-bold">Mystery Drawing</p>
          <h1 class="my-4 text-5xl font-bold leading-tight text-blue-700">
            A free, simple way to create secret lists with your friends!
          </h1>
          <p class="leading-normal text-2xl mb-8 text-blue-600">
            Mystery Drawing® is a free secret list creator for Christmas and any other festivities!</p>
        </div>
        <!--Right Col-->
      </div>
    </div>
    <div class="relative -mt-12 lg:-mt-24">
      <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
           xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <path
                d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                opacity="0.100000001"></path>
            <path
                d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                opacity="0.100000001"
            ></path>
            <path
                d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                id="Path-4" opacity="0.200000003"></path>
          </g>
          <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <path
                d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
            ></path>
          </g>
        </g>
      </svg>
    </div>
    <section class="bg-white border-b py-8">
      <div class="container max-w-5xl mx-auto m-8 ">
        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
          How it works
        </h2>
        <div class="w-full mb-4">
          <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <div class="flex flex-wrap">
          <div class="w-5/6 sm:w-1/2 p-6">

            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
              <font-awesome-icon icon="fa-solid fa-1"/>
              <div class="inline ml-2">. Create your free account.</div>
              <div class="-ml-4" v-if="!$page.props.user">
                <Link v-if="canRegister && !$page.props.user" :href="route('register')"
                      class="ml-4 text-xs text-gray-700 dark:text-gray-500 underline">Register
                </Link>
                <div class="text-sm inline"> or
                  <Link v-if="canLogin && !$page.props.user" :href="route('login')"
                        class="text-xs text-gray-700 dark:text-gray-500 underline">Log in
                  </Link>
                </div>
              </div>
            </h3>
            <p class="text-gray-800 mb-8">
              This will allow you to manage all of your lists for previous and future events.
              <small class="block mt-1 font-bold">* Only the list creator will need to register an account. </small>
            </p>
          </div>
        </div>
        <div class="flex flex-wrap flex-col-reverse sm:flex-row">
          <div class="sm:w-1/3">
            <img class="w-7/12" :src="xmasGift" alt="Christmas Gift"/>
          </div>
          <div class="w-full sm:w-1/2 p-6 mt-6">
            <div class="align-middle">
              <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                <font-awesome-icon icon="fa-solid fa-2"/>
                <div class="inline ml-2">. Create your first list.</div>
              </h3>
              <p class="text-gray-800 ">
                Create a new list with a list of your friends. You will have a secret link that your friends can access.
                Your friends will not have to register to use this link.
                The link will allow them to add their own contact info!
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="container max-w-5xl mx-auto m-8">
        <div class="w-full lg:w-1/2 p-6">
          <div class="align-middle">
            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
              <font-awesome-icon icon="fa-solid fa-3"/>
              <div class="inline ml-2">. Start the drawing!</div>
            </h3>
            <p class="text-gray-800  mb-8">
              After starting the drawing, each participant will be assigned another participant by random.
              Each participant will receive an email with who their participant is, along with the event information.
            </p>
            <div class="sm:w-1/3 mx-auto">
              <img class="w-8/12" :src="turkey" alt="Thanksgiving Turkey"/>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Footer-->
<!--    <footer class="bg-white">
      <div class="container mx-auto px-8">
        <div class="w-full flex flex-col md:flex-row py-6">
          <div class="flex-1">
            <p class="uppercase text-gray-500 md:mb-6">Links</p>
            <ul class="list-reset mb-6">
              <li class="mt-2 mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">FAQ</a>
              </li>
              <li class="mt-2  mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Help</a>
              </li>
              <li class="mt-2  mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Support</a>
              </li>
            </ul>
          </div>
          <div class="flex-1">
            <p class="uppercase text-gray-500 md:mb-6">Legal</p>
            <ul class="list-reset mb-6">
              <li class="mt-2 mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Terms</a>
              </li>
              <li class="mt-2 mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Privacy</a>
              </li>
            </ul>
          </div>
          <div class="flex-1">
            <p class="uppercase text-gray-500 md:mb-6">Social</p>
            <ul class="list-reset mb-6">
              <li class="mt-2 mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Facebook</a>
              </li>
              <li class="mt-2  mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Linkedin</a>
              </li>
              <li class="mt-2 mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Twitter</a>
              </li>
            </ul>
          </div>
          <div class="flex-1">
            <p class="uppercase text-gray-500 md:mb-6">Company</p>
            <ul class="list-reset mb-6">
              <li class="mt-2  mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Official Blog</a>
              </li>
              <li class="mt-2  mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">About Us</a>
              </li>
              <li class="mt-2  mr-2 md:block md:mr-0">
                <a href="#" class="no-underline hover:underline text-gray-800 hover:text-pink-500">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>-->
  </div>
</template>
