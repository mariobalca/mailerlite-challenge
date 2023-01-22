import sharedActions from '@/shared/store/actions'
import {FieldService} from "../field-service";

export default {
  ...sharedActions('field', FieldService)
}