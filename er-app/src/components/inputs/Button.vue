<template>
     <div class="form-group text-right">
        <button :class="customClass" class="btn text-uppercase btn-sm" type="submit">{{ customName }}</button>
    </div>
</template>
<script>
export default {
    name: 'Button',
    props: ['custom-name', 'custom-class']
}
</script>
