import React from "react";
import Layout from "../components/layout";

function Loglist() {
  return (
    <Layout>
      <div class="mt-8 overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                Sl
              </th>
              <th scope="col" class="px-6 py-3">
                Action type
              </th>
              <th scope="col" class="px-6 py-3">
                IP address
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                1
              </th>
              <td class="px-6 py-4">Registration</td>
              <td class="px-6 py-4">null</td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                2
              </th>
              <td class="px-6 py-4">login</td>
              <td class="px-6 py-4">null</td>
            </tr>
            <tr class="bg-white dark:bg-gray-800">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                3
              </th>
              <td class="px-6 py-4">change label gg.com to google.com</td>
              <td class="px-6 py-4">10.11.11.11</td>
            </tr>
          </tbody>
        </table>
      </div>
    </Layout>
  );
}
export default Loglist;
