import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";

export default function ensureLogin() {
    const authStore = useAuthStore();
    const router = useRouter()
    
    if (!authStore.isAuthenticated) {
        alert("Please Login")
        router.push({ path: '/login' })
    }
}