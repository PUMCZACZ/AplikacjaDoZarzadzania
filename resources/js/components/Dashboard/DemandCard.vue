<script setup>
import {inject} from "vue";

const data = inject('data');
</script>

<template>
                <div class="card shadow-lg p-3 mb-3 bg-body rounded">
                    <div class="card-header shadow p-3 mb-2 bg-body rounded">
                        Aktualny miesiąc
                    </div>
                    <div class="row mt-4 mb-4 px-2">
                        <div class="col-sm-4">
                            <div class="card mb-2">
                                <div class="card-header shadow p-3 mb-2 bg-body rounded">
                                    Aktualny miesiąc
                                </div>
                                <div class="card-body mb-2">
                                    {{ data.demands.demand }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-2">
                                <div class="card-header shadow p-3 mb-2 bg-body rounded">
                                    Następny miesiąc
                                </div>
                                <div class="card-body mb-2">
                                    {{ data.demands.nextMonthDemand }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-2">
                                <div class="card-header shadow p-3 mb-2 bg-body rounded">
                                    Za 2 miesiące
                                </div>
                                <div class="card-body mb-2">
                                    {{ data.demands.nextTwoMonthDemand }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
</template>

<style scoped>

</style>
