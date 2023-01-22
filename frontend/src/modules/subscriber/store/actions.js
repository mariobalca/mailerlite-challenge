import sharedActions from '@/shared/store/actions'
import { SubscriberService } from "../subscriber-service";

export default {
  ...sharedActions('subscriber', SubscriberService)
}