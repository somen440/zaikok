import axios from 'axios'

export function isGuest() {
  return axios.get('api/is_guest')
}
