<template>
	<el-container>
		<el-aside width="auto" style="height: calc(100vh)">
			<el-menu router>
				<el-menu-item></el-menu-item>
			</el-menu>
		</el-aside>
		<el-container>
			<el-header class="bg-blue-700 text-white"> WIDE DASHBOARD </el-header>
			<el-main>
				<Nuxt />
			</el-main>
		</el-container>
	</el-container>
</template>


<script>
export default {
	data() {
		return {
			menus: [],
		}
	},
}
</script>

