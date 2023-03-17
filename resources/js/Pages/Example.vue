<template>
    <div>
        Ví dụ dùng vuejs
        <inertia-link href="/">btn 1</inertia-link>
        <inertia-link href="/example">btn 2</inertia-link>
        <inertia-link :href="route('example')">btn 3</inertia-link>
        <inertia-link :href="route('root')">btn 4</inertia-link>
    </div>
</template>