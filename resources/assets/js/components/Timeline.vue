<template>
  <div class="timeline relative mb-4">

    <div class="absolute pin-t w-10 border-r border-grey-dark border-solid h-full">&nbsp;</div>
    <slot></slot>
    <div class="absolute pin-b w-10 border-r border-grey-dark border-dashed h-4 -mb-4">&nbsp;</div>

  </div>
</template>
<script>
export default {
  name: "timeline",
  data: () => ({

  })
}
</script>
