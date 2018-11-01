<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

      <slot></slot>

    </card>
  </div>
</template>

<script>
export default {
  name: "git-hub-activity-wrapper"
}
</script>
