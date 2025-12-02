package com.example.myapplicationnew

import android.content.Intent
import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.gestures.detectTapGestures
import androidx.compose.foundation.layout.*
import androidx.compose.material3.Button
import androidx.compose.material3.Text
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.input.pointer.pointerInput
import androidx.compose.ui.layout.positionOnScreen
import androidx.compose.ui.layout.onGloballyPositioned
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp

class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContent {

            val lastX by CoordinatesHolder.lastX.collectAsState()
            val lastY by CoordinatesHolder.lastY.collectAsState()

            var captureEnabled by remember { mutableStateOf(false) }
            var boxOffsetX by remember { mutableStateOf(0f) }
            var boxOffsetY by remember { mutableStateOf(0f) }

            val targetX = 663
            val targetY = 1631
            val context = this@MainActivity

            Box(
                modifier = Modifier
                    .fillMaxSize()
                    .onGloballyPositioned { layout ->
                        val pos = layout.positionOnScreen()
                        boxOffsetX = pos.x
                        boxOffsetY = pos.y
                    }
                    .pointerInput(captureEnabled) {
                        if (captureEnabled) {

                            detectTapGestures { offset ->

                                val realX = boxOffsetX + offset.x
                                val realY = boxOffsetY + offset.y

                                // 👉 Aqui sim é o lugar certo
                                CoordinatesHolder.update(realX, realY)
                            }
                        }
                    },
                contentAlignment = Alignment.Center
            ) {
                Column(
                    modifier = Modifier.fillMaxSize(),
                    horizontalAlignment = Alignment.CenterHorizontally,
                    verticalArrangement = Arrangement.Center
                ) {

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_HOME
                        )
                    }) {
                        Text("HOME")
                    }

                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_BACK
                        )
                    }) {
                        Text("VOLTAR")
                    }

                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = { captureEnabled = !captureEnabled }) {
                        Text(if (captureEnabled) "DESATIVAR" else "PEGAR TOQUE")
                    }

                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_HOME
                        )
                        MyAccessibilityService.instance?.postDelayed(1000) {
                            MyAccessibilityService.instance?.tap(targetX, targetY)
                        }
                    }) {
                        Text("BOTÃO HOME + CLICAR EM COORDENADA")
                    }

                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = {
                        // Abre apps recentes
                        MyAccessibilityService.instance?.performGlobalAction(
                            android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_RECENTS
                        )

                        // Volta automaticamente para o último app
                        MyAccessibilityService.instance?.postDelayed(200) {
                            MyAccessibilityService.instance?.performGlobalAction(
                                android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_RECENTS
                            )
                        }

                        // Agora espera o app abrir COMPLETAMENTE
                        MyAccessibilityService.instance?.postDelayed(700) {
                            val intent = Intent(context, TransparentOverlayActivity::class.java)
                            intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
                            context.startActivity(intent)
                        }
                    }) {
                        Text("Voltar + Overlay")
                    }


                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_HOME
                        )
                        MyAccessibilityService.instance?.postDelayed(1000) {
                            MyAccessibilityService.instance?.tap(172, 697)
                        }

                        MyAccessibilityService.instance?.postDelayed(5000) {
                            MyAccessibilityService.instance?.tap(946, 1902)
                        }

                        MyAccessibilityService.instance?.postDelayed(6000) {
                            MyAccessibilityService.instance?.tap(191, 1345)
                        }

                        MyAccessibilityService.instance?.postDelayed(7000) {
                            MyAccessibilityService.instance?.tap(872, 1729)
                        }

                        MyAccessibilityService.instance?.postDelayed(8000) {
                            MyAccessibilityService.instance?.tap(191, 1345)
                        }

                        MyAccessibilityService.instance?.postDelayed(9000) {
                            MyAccessibilityService.instance?.tap(872, 1729)
                        }

                    }) {
                        Text("CLICAR EM CONJ DE COORDENADAS")
                    }

                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        val service = MyAccessibilityService.instance ?: return@Button

                        var t = 0L   // controla o tempo acumulado

                        // 1 - Abrir notificações (swipe topo → baixo)
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 540,
                                startY = 10,
                                endX = 540,
                                endY = 1400,
                                duration = 300
                            )
                        }

                        // 2 - Ícone do gravador
                        t += 1000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 3 - Botão "Áudio"
                        t += 1000
                        service.postDelayed(t) { service.tap(732, 212) }

                        // 4 - Botão "Iniciar"
                        t += 1000
                        service.postDelayed(t) { service.tap(729, 378) }

                        // 🔴 AGUARDA 10s gravando
                        t += 6000


                        // 5 - Abrir notificações novamente
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 540,
                                startY = 10,
                                endX = 540,
                                endY = 1400,
                                duration = 300
                            )
                        }

                        // 6 - Ícone do gravador → parar
                        t += 1000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 8 - Ícone gravador → iniciar
                        t += 5000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 4 - Botão "Iniciar confirmar"
                        t += 1000
                        service.postDelayed(t) { service.tap(729, 378) }

                        // 🔴 5s gravando novamente
                        t += 4000

                        // 9 - Abrir notificações
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 540,
                                startY = 10,
                                endX = 540,
                                endY = 1400,
                                duration = 300
                            )
                        }

                        // 10 - Ícone gravador → finalizar
                        t += 1000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 11 - Limpar notificação
                        t += 2000
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 200,
                                startY = 306,
                                endX = 600,
                                endY = 306,
                                duration = 300
                            )
                        }

                        t += 1200
                        service.postDelayed(t) {
                            service.performGlobalAction(
                                android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_BACK
                            )
                        }

                    }) {
                        Text("ATIVAR GRAVADOR")
                    }



                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        val service = MyAccessibilityService.instance ?: return@Button

                        // Ir para Home
                        service.performGlobalAction(
                            android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_HOME
                        )
                        service.postDelayed(1000) { service.tap(705, 756) }
                    }) {
                        Text("CLICAR NO TABLET FISICO")
                    }

                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        val service = MyAccessibilityService.instance ?: return@Button

                        var t = 0L

                        // 0 - Ir para Home imediatamente
                        service.performGlobalAction(
                            android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_HOME
                        )

                        // 1 - abrir app
                        t += 1000
                        service.postDelayed(t) { service.tap(705, 756) }

                        // 2 - clicar na lupa
                        t += 2000
                        service.postDelayed(t) { service.tap(30, 516) }

                        // 3 - campo de pesquisa
                        t += 1000
                        service.postDelayed(t) { service.tap(169, 41) }

                        // 4 - nome
                        t += 1000
                        service.postDelayed(t) { service.tap(345, 155) }

                        // 5 - contas
                        t += 1000
                        service.postDelayed(t) { service.tap(299, 99) }

                        // 6 - foto
                        t += 1000
                        service.postDelayed(t) { service.tap(386, 159) }

                        // 7 - 3 pontos
                        t += 1000
                        service.postDelayed(t) { service.tap(772, 53) }

                        // 8 - desbloquear 1
                        t += 1000
                        service.postDelayed(t) { service.tap(522, 900) }

                        // 9 - desbloquear 2
                        t += 1000
                        service.postDelayed(t) { service.tap(502, 672) }

                        // 10 - confirmar desbloqueio
                        t += 1000
                        service.postDelayed(t) { service.tap(458, 682) }

                        // 11 - voltar
                        t += 1200
                        service.postDelayed(t) {
                            service.performGlobalAction(
                                android.accessibilityservice.AccessibilityService.GLOBAL_ACTION_BACK
                            )
                        }

                        // 12 - foto novamente
                        t += 1200
                        service.postDelayed(t) { service.tap(386, 159) }

                        // 13 - principal sz
                        t += 2500
                        service.postDelayed(t) { service.tap(188, 124) }

                        // 14 - início da timeline interna
                        service.postDelayed(t) {
                            service.executarTimelineInterna()
                        }




                    }) {
                        Text("CONJ COORD NO TABLET FISICO")
                    }

                    Spacer(modifier = Modifier.height(40.dp))

                    Text(
                        text = "X: ${lastX.toInt()}\nY: ${lastY.toInt()}",
                        fontSize = 40.sp,
                        fontWeight = FontWeight.Bold
                    )
                }
            }
        }
    }
}
