<script  setup>
import {onMounted, reactive, ref} from "vue";
import {useRoute} from 'vue-router';

import{useLeadStore} from '../../stores/store-leads';

const store=useLeadStore();
const route = useRoute();
onMounted(async () => {
    document.title = 'Leads - Dashoard';
   store.getDashboardData();

});

function capitalize(text) {
  if (!text) return '';
  return text.charAt(0).toUpperCase() + text.slice(1);
}
const formatDate = (date) => {
  if (!date) return '';

  return new Date(date).toLocaleDateString('en-IN', {
    day: '2-digit',
    month: 'short',
    year: 'numeric'
  });
};


const getFollowupStatus = (item) => {
  const today = new Date();
  const followupDate = new Date(item.follow_up_date);

  // Remove time part for comparison
  today.setHours(0,0,0,0);
  followupDate.setHours(0,0,0,0);

  if (followupDate.getTime() === today.getTime()) {
    return 'Today';
  } else if (followupDate < today) {
    return 'Missed';
  } else {
    return 'Upcoming';
  }
};
const getFollowupStatusClass = (item) => {
  const status = getFollowupStatus(item);

  return {
    'text-yellow-600 font-medium': status === 'Today',
    'text-red-600 font-medium': status === 'Missed',
    'text-green-600 font-medium': status === 'Upcoming',
  };
};
const getFollowupRowClass = (item) => {
  const status = getFollowupStatus(item);

  return {
    'border-b': true,
    'bg-red-50': status === 'Missed',
    'bg-yellow-50': status === 'Today',
  };
};

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
      <h2 class="text-3xl font-bold mt-2">{{store.dashboard_data?.total_leads}}</h2>
    </div>

    <!-- Leads by Status -->
    <div class="bg-white p-5 rounded-2xl shadow">
  <p class="text-gray-500 text-sm">Leads by Status</p>

  <div class="mt-3 space-y-1 text-sm">
    <p
      v-for="(item, index) in store.dashboard_data?.leads_by_status"
      :key="index"
      class="flex justify-between gap-2 py-1"
    >
      <span>{{ capitalize(item.status_name) }}</span>
      <span>{{ item.total }}</span>
    </p>
  </div>
</div>

    <!-- My Follow-ups Today -->
    <div class="bg-yellow-50 p-5 rounded-2xl shadow border-l-4 border-yellow-400">
      <p class="text-gray-600 text-sm">My Follow-ups Today</p>
      <h2 class="text-3xl font-bold mt-2 text-yellow-600">{{store.dashboard_data?.today_followups}}</h2>
    </div>

    <!-- Missed Follow-ups -->
    <div class="bg-red-50 p-5 rounded-2xl shadow border-l-4 border-red-400">
      <p class="text-gray-600 text-sm">Missed Follow-ups</p>
      <h2 class="text-3xl font-bold mt-2 text-red-600">{{store.dashboard_data?.missed_followups}}</h2>
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
          <th>Follow UP Status</th>
        </tr>
      </thead>
      <tbody>
  <tr v-for="item in store.dashboard_data?.recent_followups" :key="item.id"
      :class="getFollowupRowClass(item)">
      
    <!-- Lead Name -->
    <td class="py-2">
      {{ item.lead_name }}
    </td>

    <!-- Date -->
    <td>
      {{ formatDate(item.follow_up_date) }}
    </td>

    <!-- Status -->
    <td>
      <span :class="getFollowupStatusClass(item)">
        {{ getFollowupStatus(item) }}
      </span>
    </td>

  </tr>
</tbody>
    </table>

  </div>
  </div>
</template>


