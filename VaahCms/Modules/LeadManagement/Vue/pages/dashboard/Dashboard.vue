<script  setup>
 document.title = 'LeadManagement';
</script>
<template  >

  <!-- <div style="margin-top: 8px;">
    <h1 class="text-4xl">Lead Management Dashboard</h1>
  </div> -->
  <div class="bg-gray-100 p-3">
<!-- <div class="mb-4">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
  </div> -->

  <!-- Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Total Leads -->
    <div class="bg-white p-5 rounded-2xl shadow">
      <p class="text-gray-500 text-sm">Total Leads</p>
      <h2 class="text-3xl font-bold mt-2">120</h2>
    </div>

    <!-- Leads by Status -->
    <div class="bg-white p-5 rounded-2xl shadow">
      <p class="text-gray-500 text-sm">Leads by Status</p>
      <div class="mt-3 space-y-1 text-sm">
        <p class="flex justify-between"><span>New</span><span>30</span></p>
        <p class="flex justify-between"><span>Contacted</span><span>50</span></p>
        <p class="flex justify-between"><span>Converted</span><span>20</span></p>
        <p class="flex justify-between"><span>Closed</span><span>20</span></p>
      </div>
    </div>

    <!-- My Follow-ups Today -->
    <div class="bg-yellow-50 p-5 rounded-2xl shadow border-l-4 border-yellow-400">
      <p class="text-gray-600 text-sm">My Follow-ups Today</p>
      <h2 class="text-3xl font-bold mt-2 text-yellow-600">8</h2>
    </div>

    <!-- Missed Follow-ups -->
    <div class="bg-red-50 p-5 rounded-2xl shadow border-l-4 border-red-400">
      <p class="text-gray-600 text-sm">Missed Follow-ups</p>
      <h2 class="text-3xl font-bold mt-2 text-red-600">3</h2>
    </div>

  </div>

  <!-- Recent Activity Section -->
  <div class="mt-8 bg-white rounded-2xl shadow p-5">
    <h2 class="text-lg font-semibold mb-4">Recent Follow-ups</h2>

    <table class="w-full text-sm">
      <thead>
        <tr class="text-left text-gray-500 border-b">
          <th class="py-2">Lead</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b">
          <td class="py-2">John Doe</td>
          <td>25 Mar 2026</td>
          <td><span class="text-yellow-600 font-medium">Today</span></td>
        </tr>
        <tr class="border-b bg-red-50">
          <td class="py-2">Jane Smith</td>
          <td>24 Mar 2026</td>
          <td><span class="text-red-600 font-medium">Missed</span></td>
        </tr>
        <tr>
          <td class="py-2">Alex Brown</td>
          <td>26 Mar 2026</td>
          <td><span class="text-green-600 font-medium">Upcoming</span></td>
        </tr>
      </tbody>
    </table>

  </div>
  </div>
</template>


