import {ElNotification as Notification} from 'element-plus'

export default class Message {
  static success(payload) {
    Notification({
      title: '',
      showClose: true,
      message: payload,
      type: 'success',
      duration: 6000,
      position: 'bottom-right'
    })
  }

  static error(payload) {
    let message = payload

    if (!message) {
      message = ''
    }

    Notification({
      title: '',
      showClose: true,
      message,
      type: 'error',
      duration: 6000,
      position: 'bottom-right'
    })
  }
}
