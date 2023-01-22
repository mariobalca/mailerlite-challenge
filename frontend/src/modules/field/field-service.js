import axios from '@/shared/axios'

export class FieldService {

  static async list() {
    const response = await axios.get(
      `/field`
    )

    return response.data
  }

  static async create(data) {
    const response = await axios.post(
      `/field`,
      data
    )

    return response.data
  }

  static async find(id) {
    const response = await axios.get(
      `/field/${id}`
    )

    return response.data
  }

  static async update(id, data) {
    const response = await axios.put(
      `/field/${id}`,
      data
    )

    return response.data
  }


  static async destroy(id) {
    const response = await axios.delete(
      `/field/${id}`
    )

    return response.data
  }
}
