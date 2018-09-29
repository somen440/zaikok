import axios from 'axios'

export function isGuest() {
  return axios.get('api/is_guest')
}
export function registerUser(param) {
  return axios.post('api/user/register', param)
}
