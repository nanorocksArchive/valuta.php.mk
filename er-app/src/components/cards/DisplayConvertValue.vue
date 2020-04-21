<template>
    <div class="card mt-2 pt-5 pb-5">
        <div class="card-body text-center">
            <span class="display-1">{{ customValue }}</span>
            <small class="font-weight-bold text-uppercase">{{ customRate }}</small>
        </div>
    </div>
</template>
<script>
export default {
  name: 'DisplayConvertValue',
  props: ['custom-value', 'custom-rate']
}
</script>
