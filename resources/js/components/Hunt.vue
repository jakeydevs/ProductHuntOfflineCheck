<template>
    <div>
        <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
            <a :href="hunt.redirect_url" target="_blank">
                <div
                    class="-ml-4 -mt-4 flex justify-between items-center flex-wrap sm:flex-no-wrap"
                >
                    <div class="ml-4 mt-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img
                                    class="h-12 rounded"
                                    :src="hunt.thumbnail.image_url"
                                    alt=""
                                />
                            </div>
                            <div class="ml-4">
                                <h3
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    {{ hunt.name }}
                                </h3>
                                <p class="text-sm leading-5 text-gray-500">
                                    {{ hunt.tagline }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="ml-4 mt-4 flex-shrink-0 flex">
                        {{ hunt.votes_count }}
                    </div>
                </div>
            </a>
        </div>
        <div v-if="state == 0" class="bg-gray-200 px-6 py-2">
            <svg
                class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-600"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                ></circle>
                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                ></path>
            </svg>
        </div>
        <div v-if="state == 1" class="bg-green-200 px-6 py-2">Online</div>
        <div v-if="state == 2" class="bg-red-200 px-6 py-2">Offline</div>
    </div>
</template>

<script>
export default {
    props: {
        hunt: {
            required: true,
            type: Object
        },
        api: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            state: 0
        };
    },
    mounted() {
        setTimeout(() => {
            this.checkOnline();
        }, Math.floor(Math.random() * Math.floor(100)));
    },
    methods: {
        checkOnline() {
            window.axios
                .get(this.api, {
                    params: {
                        url: this.hunt.redirect_url
                    }
                })
                .then(resp => {
                    if (resp.data.success) {
                        this.state = 1;
                    } else {
                        this.state = 2;
                    }
                });
        },
        view() {
            window.location = this.hunt.redirect_url;
        }
    }
};
</script>
