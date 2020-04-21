<template>
     <div class="form-group">
        <label class="font-weight-bolder text-uppercase small">{{ customLabel }}</label>
        <input type="number" class="form-control" :placeholder="customPlaceholder" v-model="text" @input="inputValue" required>
    </div>
</template>
<script>
export default {
    name: 'TextField',
    props: ['custom-label', 'custom-placeholder'],
    data() {
        return {
            text: ''
        }
    },
    methods: {
        inputValue: function () {
            this.$emit('get-text',this.text);
        }
    }

}
</script>
