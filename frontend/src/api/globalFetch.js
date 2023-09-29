import { getLocalStorage } from "../hooks/useLocalStorage";
const BASE_URL = "http://localhost/api/";

export async function send(
  endPoint,
  payloadData,
  method = "POST",
  config = {}
) {
  const BASE_CONFIG = { headers: { "Content-Type": "application/json" } };

  try {
    
    const user = getLocalStorage("user");

    if (user && user.token) {
      BASE_CONFIG.headers.Authorization = "Bearer " + user.token;
    }
    BASE_CONFIG.method = method;
    BASE_CONFIG.body = JSON.stringify(payloadData);
    const response = await fetch(BASE_URL + endPoint, {
      ...BASE_CONFIG,
      ...config,
    });
    return response.json();
  } catch (error) {
    console.log("Something Wrong" + error);
  }
}

export async function get(endPoint, config = {}) {
  const BASE_CONFIG = { headers: { "Content-Type": "application/json" } };

  try {
    const user = getLocalStorage("user");
    BASE_CONFIG.method='GET'
    if (user && user.token) {
      BASE_CONFIG.headers.Authorization = "Bearer " + user.token;
    }

    const response = await fetch(BASE_URL + endPoint, {
      ...BASE_CONFIG,
      ...config,
    });

    return await response.json();
  } catch (error) {
    console.log("Something Wrong" + error);
  }
}
