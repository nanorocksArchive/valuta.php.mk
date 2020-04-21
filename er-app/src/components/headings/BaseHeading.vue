<template>
    <div class="row">
      <div class="col pl-lg-0 pr-lg-0 pl-md-0 pr-md-0">
        <h1 class="pb-3 text-muted font-weight-light text-uppercase">{{ customHeading }}</h1>
      </div>
    </div>
</template>
<script>
export default {
    name: 'BaseHeading',
    props: ['custom-heading']
}
</script>