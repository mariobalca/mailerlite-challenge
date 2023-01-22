import axios from '@/shared/axios'

export class SubscriberService {

  static async list() {
    const response = await axios.get(
      `/subscriber`
    )

    return response.data
  }

  static async create(data) {
    const response = await axios.post(
      `/subscriber`,
      data
    )

    return response.data
  }

  static async find(id) {
    const response = await axios.get(
      `/subscriber/${id}`
    )

    return response.data
  }

  static async update(id, data) {
    const response = await axios.put(
      `/subscriber/${id}`,
      data
    )

    return response.data
  }


  static async destroy(id) {
    const response = await axios.delete(
      `/subscriber/${id}`
    )

    return response.data
  }
}
