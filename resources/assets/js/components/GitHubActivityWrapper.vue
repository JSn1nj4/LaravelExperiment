<template lang="html">
  <div class="github-activity-item">
    <card :size="'sm'" type="transparent">

      <div class="flex flex-row relative">

        <slot></slot>

      </div>

    </card>
  </div>
</template>

<script>
export default {
  name: "git-hub-activity-wrapper"
}
</script>
