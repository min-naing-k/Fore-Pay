 <!-- Sidebar Start -->
 <div class="side-bar active bg-slate-900 overflow-hidden fixed min-h-screen z-40 md:translate-x-0">
   <!-- Cross -->
   <div class="cross absolute right-1 p-2 text-slate-400 hover:text-sky-400 cursor-pointer z-50">
     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
     </svg>
   </div>
   <!-- Sidebar Header -->
   <div class="flex items-center relative px-4 h-16">
     <!-- Logo -->
     <a href="/admin" class="flex items-center w-full font-poppins text-xl font-bold text-gray-200 cursor-pointer">
       <div class="mr-1">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
             d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
         </svg>
       </div>
       <span class="logo">Fore Pay</span>
     </a>
     <div class="divider absolute bottom-0 bg-slate-700" style="height: 1px"></div>
   </div>

   <!-- Sidebar Content -->
   <div>
     <!-- Search For Mobile -->
     <div class="flex px-3 pt-4 md:hidden">
       <div class="flex w-full max-w-xs bg-slate-800 rounded-lg h-12 border-t border-t-gray-700">
         <label class="flex items-center pl-4" for="search">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
           </svg>
         </label>
         <input type="text" id="search" class="w-full bg-transparent border-none focus:ring-0 text-slate-400" placeholder="Search..." autocomplete="off">
       </div>
     </div>

     <!-- Sidebar Links -->
     <div class="pt-4 px-3 md:pt-7">
       <h1 class="title text-slate-400 text-base pb-3">Menu</h1>
       <ul class="space-y-4">
         <li>
           <x-backend.sidebar-link href="{{ route('admin.dashboard') }}" :active="request()->is('admin')">
             <x-slot name="icon">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
               </svg>
             </x-slot>
             Dashboard
           </x-backend.sidebar-link>
         </li>
         <li>
           <x-backend.sidebar-link href="{{ route('admin.admin-user.index') }}" :active="request()->is('admin/admin-user*')">
             <x-slot name="icon">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
               </svg>
             </x-slot>
             Admin Users Management
           </x-backend.sidebar-link>
         </li>
       </ul>
     </div>
   </div>
 </div> <!-- Sidebar End -->
