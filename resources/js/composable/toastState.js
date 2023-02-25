import { ref } from 'vue'

const show = function (message) {
    successToast.visible.value = false
    dangerToast.visible.value = false

    this.visible.value = true
    this.text.value = message
}

const successToast = {
    visible: ref(false),
    text: ref(''),
    show,
}

const dangerToast = {
    visible: ref(false),
    text: ref(''),
    show,
}

export function useToast() {
    return {
        successToast,
        dangerToast,
    }
}
